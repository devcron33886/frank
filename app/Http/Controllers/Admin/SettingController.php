<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyShopRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Setting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shops = Setting::with(['media'])->get();

        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shops.create');
    }

    public function store(StoreShopRequest $request)
    {
        $shop = Setting::create($request->all());

        if ($request->input('logo', false)) {
            $shop->addMedia(storage_path('tmp/uploads/'.basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $shop->id]);
        }

        return redirect()->route('admin.shops.index');
    }

    public function edit(Setting $shop)
    {
        abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shops.edit', compact('shop'));
    }

    public function update(UpdateShopRequest $request, Setting $shop)
    {
        $shop->update($request->all());

        if ($request->input('logo', false)) {
            if (! $shop->logo || $request->input('logo') !== $shop->logo->file_name) {
                if ($shop->logo) {
                    $shop->logo->delete();
                }
                $shop->addMedia(storage_path('tmp/uploads/'.basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($shop->logo) {
            $shop->logo->delete();
        }

        return redirect()->route('admin.shops.index');
    }

    public function show(setting $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shops.show', compact('shop'));
    }

    public function destroy(Setting $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopRequest $request)
    {
        Setting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('shop_create') && Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Shop();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
