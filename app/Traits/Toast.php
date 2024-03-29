<?php

namespace App\Traits;

trait Toast
{
    /**
     * Dispatch a toast event.
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function toast($type, $message) {
        $this->dispatch('toast', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
