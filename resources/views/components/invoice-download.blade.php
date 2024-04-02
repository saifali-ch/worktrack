<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Invoice</title>
  <style>
    @font-face {
      font-family: 'Gotham Rounded Book';
      src: url({{ storage_path('fonts/GothamRounded-Book.ttf') }}) format("truetype");
    }

    @font-face {
      font-family: 'Gotham Rounded Bold';
      src: url({{ storage_path('fonts/GothamRounded-Bold.ttf') }}) format("truetype");
    }

    @font-face {
      font-family: 'Gotham Rounded Medium';
      src: url({{ storage_path('fonts/GothamRounded-Medium.ttf') }}) format("truetype");
    }

    body {
      font: normal 12px 'Gotham Rounded Book', sans-serif;
      color: #4F525B;
    }

    table {
      width: 100%;
    }

    th, td {
      padding: 4px 0;
    }

    .page {
      position: relative;
    }

    .page-break {
      page-break-after: always;
    }

    .page .number {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: -24px;
    }

    .page .number::before {
      content: "Page | ";
    }

    .font-medium {
      font-family: 'Gotham Rounded Medium', sans-serif;
    }

    .ml-6 {
      margin-left: 24px;
    }

    .my-2 {
      margin: 8px 0;
    }

    .text-sm {
      font-size: 14px;
    }

    .text-lg {
      font-size: 18px;
      line-height: 28px;
    }

    .text-accent {
      color: #040304;
    }

    .text-end {
      text-align: right;
    }

    .w-130 {
      width: 130px;
    }

    .w-150 {
      width: 150px;
    }

    .shift-heading {
      background-color: #F2F2F2;
      border-radius: 12px;

      padding: 12px 16px 12px 16px;
    }

    .shift-table {
      padding: 0 16px 16px 16px;
      border-bottom: 1px dashed #E8E8E8;
    }

    .shift-table td {
      padding: 0;
    }

    .rate {
      padding: 16px 16px 4px 16px;
    }

    .total {
      padding: 4px 16px 16px 16px;
    }

    .grand-total-table {
      border-top: 0.5px solid black;
      border-bottom: 1px dashed #E8E8E8;
      padding: 32px 16px;
    }

    .bank-details-table {
      padding: 32px 16px;
    }
  </style>
</head>

<body>
@php
  $totalShifts = $shifts->count();
  $shiftsPerPage = 4;
  $totalPages = ceil($totalShifts / $shiftsPerPage);
@endphp

@for($page = 1; $page <= $totalPages; $page++)
  <div class="page">
    @if($page == 1)
      <table>
        <tr>
          <td>Full Name:</td>
          <td class="text-sm text-accent">{{ $user->name }}</td>
          <td>Invoice ID</td>
          <td class="font-medium text-sm text-accent text-end w-150">{{ $invoice->padded_id }}</td>
        </tr>
        <tr>
          <td>Address:</td>
          <td class="text-sm text-accent">{{ $user->address }}</td>
          <td>Invoice Date</td>
          <td class="font-medium text-sm text-accent text-end w-150">{{ $invoice->created_at->format('F d, Y') }}</td>
        </tr>
        <tr>
          <td>Post Code:</td>
          <td class="text-sm text-accent">{{ $user->post_code }}</td>
        </tr>
        <tr>
          <td>To:</td>
          <td class="text-sm text-accent">Ablou Facilities Ltd</td>
        </tr>
      </table>
    @endif

    @foreach ($shifts->forPage($page, $shiftsPerPage) as $index => $shift)
      <section class="my-2">
        <h2 class="shift-heading font-medium text-sm text-accent">Shift {{  $index + 1 }}</h2>
        <table class="shift-table">
          <tr>
            <td>Date</td>
            <td>Site</td>
            <td>Start</td>
            <td>Finish</td>
          </tr>
          <tr>
            <td class="text-sm text-accent">{{ $shift->date->format('F d, Y') }}</td>
            <td class="text-sm text-accent">{{ $shift->site->name }}</td>
            <td class="text-sm text-accent">{{ $shift->start_time->format('h:i A') }}</td>
            <td class="text-sm text-accent">{{ $shift->finish_time->format('h:i A') }}</td>
          </tr>
        </table>
        <div class="single-shift-total text-end">
          <div class="rate">Rate:
            <span class="text-sm ml-6">
                {{ \Illuminate\Support\Number::currency($shift->rate, 'GBP') }}
              </span>
          </div>
          <div class="total font-medium"> Total:
            <span class="text-sm text-accent ml-6">
                {{ \Illuminate\Support\Number::currency($shift->total, 'GBP') }}
              </span>
          </div>
        </div>
      </section>
    @endforeach

    @if($page == $totalPages)
      <table class="grand-total-table">
        <tr>
          <td class="font-medium">Total:</td>
          <td class="font-medium text-lg text-accent text-end">{{ $grandTotal }}</td>
        </tr>
      </table>
      <table class="bank-details-table">
        <h2 class="font-medium text-sm text-accent">Bank Details</h2>
        <tr>
          <td class="w-130">Acc Name:</td>
          <td class="text-sm text-accent">{{ $user->account_name }}</td>
        </tr>
        <tr>
          <td class="w-130">Sort Code:</td>
          <td class="text-sm text-accent">{{ $user->short_code }}</td>
        </tr>
        <tr>
          <td class="w-130">Account Number:</td>
          <td class="text-sm text-accent">{{ $user->redacted_account_number }}</td>
        </tr>
      </table>
    @endif
    <div class="number">{{ $page }}</div>
  </div>

  @if($page != $totalPages)
    <div class="page-break"></div>
  @endif
@endfor
</body>
</html>
