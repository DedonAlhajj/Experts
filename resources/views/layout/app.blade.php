<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Skillhunt')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('layout.styles')
</head>
<body>

<div class="alert-wrapper">

    {{-- يفضل وضعه داخل body مباشرة أو في منطقة ثابتة --}}
    @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
        <div class="side-alert warning">
            <span class="alert-icon">⚠️</span>
            Your email address is <strong>unverified</strong>.
            <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="d-inline">
                @csrf
                <button type="submit" class="resend-button">Click here to re-send the verification email</button>
            </form>
        </div>
    @endif

    @if (session('status') === 'verification-link-sent')
        <div class="side-alert success">
            <span class="alert-icon">✅</span>
            <div class="alert-body">A new verification link has been sent to your email address.</div>
            <div style="height: 119px;"></div> {{-- عنصر فارغ ليعادل مكان الزر في الرسالة الأخرى --}}
        </div>
    @endif
</div>




@include('layout.navigation')




@yield('content')



@include('layout.footer')

@include('layout.scripts')
</body>
</html>
