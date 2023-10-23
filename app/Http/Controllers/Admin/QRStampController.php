<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\QRStampService;
use Illuminate\Http\Request;

class QRStampController extends Controller
{
    protected $qrStampService;

    public function __construct(QRStampService $qrStampService)
    {
        $this->qrStampService = $qrStampService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $limit = $request->get('limit');

        $qrStamps = $this->qrStampService->getQRStamps($search, $limit);

        return response()->apiSuccess($qrStamps);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $qrStamp = $this->qrStampService->createQrstamp($data);

        return response()->apiSuccess($qrStamp);
    }
}
