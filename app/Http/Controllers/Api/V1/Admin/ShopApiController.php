<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Resources\Admin\ShopResource;
use App\Models\Shop;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ShopApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopResource(Shop::all());
    }

    public function store(StoreShopRequest $request)
    {
        $shop = Shop::create($request->all());

        if ($request->input('logo', false)) {
            $shop->addMedia(storage_path('tmp/uploads/'.basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new ShopResource($shop))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Shop $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopResource($shop);
    }

    public function update(UpdateShopRequest $request, Shop $shop)
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

        return (new ShopResource($shop))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Shop $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
