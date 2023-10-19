<?php

namespace App\Observers;

use App\Models\QRStamp;
use App\Services\Admin\QRStampService;
use App\Services\S3Service;

class QRStampObserver
{
    protected $qrStampService;
    protected $s3Service;
    public function __construct(QRStampService $qrStampService, S3Service $s3Service)
    {
        $this->s3Service = $s3Service;
        $this->qrStampService = $qrStampService;
    }

    /**
     * Handle the QRStamp "created" event.
     *
     * @param  \App\Models\QRStamp  $qrStamp
     * @return void
     */
    public function created(QRStamp $qrStamp)
    {
        try {
            \Log::debug('[START] Upload QR Code Image:', [$qrStamp->id]);
            $qrCodeImage = $this->qrStampService->generateQRCode($qrStamp->id);
            $this->s3Service->uploadQRCodeFile($qrCodeImage, QRStamp::QRSTAMP_FOLDER, $qrStamp->id);
            \Log::debug('[DONE] Upload QR Code Image:', [$qrStamp->id]);
        } catch (\Exception $e) {
            \Log::debug('[FAIL] Upload QR Code Image:', [$qrStamp->id]);
            \Log::debug($e->getMessage());
        }
    }

    /**
     * Handle the QRStamp "updated" event.
     *
     * @param  \App\Models\QRStamp  $qrStamp
     * @return void
     */
    public function updated(QRStamp $qrStamp)
    {
        //
    }

    /**
     * Handle the QRStamp "deleted" event.
     *
     * @param  \App\Models\QRStamp  $qrStamp
     * @return void
     */
    public function deleted(QRStamp $qrStamp)
    {
        //
    }

    /**
     * Handle the QRStamp "restored" event.
     *
     * @param  \App\Models\QRStamp  $qrStamp
     * @return void
     */
    public function restored(QRStamp $qrStamp)
    {
        //
    }

    /**
     * Handle the QRStamp "force deleted" event.
     *
     * @param  \App\Models\QRStamp  $qrStamp
     * @return void
     */
    public function forceDeleted(QRStamp $qrStamp)
    {
        //
    }
}
