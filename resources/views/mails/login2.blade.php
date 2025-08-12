<x-mail::message>
    # Login Notification
    Hi {{ $user->name }},
    We noticed a login to your account from:
    IP Address: {{ $ip }}
    Time: {{ $time }}>
    Browser: {{ $browser }}
    If this was you, you can ignore this email.
    If not, please

    <x-mail::button :url="''">
        Reset Password
    </x-mail::button>

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
