@php
    $logoUrl = asset('img/logokkp.jpg');
@endphp

<style>
    .qr-modal-content {
        text-align: center;
        padding: 1rem;
        font-family: 'Inter', system-ui, sans-serif;
    }

    .qr-code-wrapper {
        display: inline-block;
        padding: 20px;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        position: relative;
        margin-bottom: 16px;
    }

    .qr-code-wrapper .center-logo {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 48px; height: 48px;
        border-radius: 50%;
        border: 3px solid #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        object-fit: cover;
        background: white;
        pointer-events: none;
    }

    .qr-label {
        font-size: 15px; font-weight: 600;
        color: #1e293b; margin-bottom: 4px;
    }

    .qr-sublabel {
        font-size: 12px; color: #94a3b8; margin-bottom: 16px;
    }

    .qr-action-bar {
        display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;
    }
    .qr-action-bar button, .qr-action-bar a {
        padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600;
        cursor: pointer; text-decoration: none; border: none; transition: all 0.2s ease;
    }
    .btn-png { background: #10b981; color: white; }
    .btn-png:hover { background: #059669; }
    .btn-svg { background: #3b82f6; color: white; }
    .btn-svg:hover { background: #2563eb; }
    .btn-print { background: #64748b; color: white; }
    .btn-print:hover { background: #475569; }
</style>

<div x-data="qrDownloader" class="qr-modal-content">

    <div class="qr-code-wrapper">
        {!! QrCode::size(220)->errorCorrection('H')->generate($url) !!}
        <img src="{{ $logoUrl }}" alt="Logo" class="center-logo">
    </div>

    <div class="qr-label">{{ $label }}</div>
    <div class="qr-sublabel">Pindai untuk melihat detail aset</div>

    <div class="qr-action-bar">
        <button type="button" class="btn-png"
                x-on:click="downloadPng('{{ $label }}-qrcode.png')">
            Download PNG
        </button>
        <a href="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(400)->errorCorrection('H')->generate($url)) }}"
           download="{{ $label }}-qrcode.svg"
           class="btn-svg">
            Download SVG
        </a>
        <button type="button" class="btn-print" onclick="window.print()">
            Print
        </button>
    </div>
</div>
