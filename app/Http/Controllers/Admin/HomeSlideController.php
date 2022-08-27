<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHomeSlideRequest;
use App\Http\Requests\StoreHomeSlideRequest;
use App\Http\Requests\UpdateHomeSlideRequest;
use App\Models\HomeSlide;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HomeSlideController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('home_slide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeSlides = HomeSlide::with(['media'])->get();

        return view('admin.homeSlides.index', compact('homeSlides'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_slide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSlides.create');
    }

    public function store(StoreHomeSlideRequest $request)
    {
        $homeSlide = HomeSlide::create($request->all());

        if ($request->input('image', false)) {
            $homeSlide->addMedia(storage_path('tmp/uploads/'.basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $homeSlide->id]);
        }

        return redirect()->route('admin.home-slides.index');
    }

    public function edit(HomeSlide $homeSlide)
    {
        abort_if(Gate::denies('home_slide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSlides.edit', compact('homeSlide'));
    }

    public function update(UpdateHomeSlideRequest $request, HomeSlide $homeSlide)
    {
        $homeSlide->update($request->all());

        if ($request->input('image', false)) {
            if (! $homeSlide->image || $request->input('image') !== $homeSlide->image->file_name) {
                if ($homeSlide->image) {
                    $homeSlide->image->delete();
                }
                $homeSlide->addMedia(storage_path('tmp/uploads/'.basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($homeSlide->image) {
            $homeSlide->image->delete();
        }

        return redirect()->route('admin.home-slides.index');
    }

    public function show(HomeSlide $homeSlide)
    {
        abort_if(Gate::denies('home_slide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSlides.show', compact('homeSlide'));
    }

    public function destroy(HomeSlide $homeSlide)
    {
        abort_if(Gate::denies('home_slide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeSlide->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeSlideRequest $request)
    {
        HomeSlide::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('home_slide_create') && Gate::denies('home_slide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new HomeSlide();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
