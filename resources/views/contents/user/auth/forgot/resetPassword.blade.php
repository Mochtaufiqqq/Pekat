<p>Hello, </p>

<p>Kami menerima permintaan untuk mengatur ulang kata sandi untuk akun Anda. Jika Anda membuat permintaan ini, ikuti petunjuk di bawah ini:</p>

<p><a class="btn-custom" href="{{ url('password/reset/email/'.$token) }}">Reset password</a></p>

<p>Jika Anda tidak meminta pengaturan ulang kata sandi, tidak diperlukan tindakan lebih lanjut.</p>

{{-- <p>Best regards,</p> --}}

<p class="text-muted">Claire Team</p>

<style>
    .btn-custom{
        background-color: aqua;
        color: black;
    }
</style>