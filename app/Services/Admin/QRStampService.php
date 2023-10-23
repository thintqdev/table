<?php

namespace App\Services\Admin;

use App\Models\QRStamp;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRStampService extends AbstractService
{
    public function getQRStamps($search, $limit)
    {
        $query = QRStamp::with('shop')->where('title', 'LIKE', '%'.$search.'%');

        if (! is_null($this->user()->shop_id)) {
            $query->where('shop_id', $this->user()->shop_id);
        }

        $qrStamps = $query->paginate($limit ?? config('const.paginate'));
        $qrStamps->getCollection()->each(function ($stamp) {
            $stamp->append(['shop_name', 'qr_stamp_url']);
            $stamp->makeHidden(['shop', 'upload']);
        });

        return $qrStamps;
    }

    public function createQrstamp($data)
    {
        $data['sha256_hash'] = hash_hmac('sha256', now(), false);
        $data['shop_id'] = $this->user()->shop_id;

        $stamps = QRStamp::create($data);

        return $stamps;
    }

    public function generateQRCode($qrStampId)
    {
        $qrStamp = QRStamp::where('id', $qrStampId)->firstOrFail();

        $qrCode = QrCode::format('png')
            ->size(250)
            ->generate($qrStamp->sha256_hash);

        return $qrCode;
    }
}
