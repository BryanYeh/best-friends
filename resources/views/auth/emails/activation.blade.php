Hi, {{ $first_name }}

Thank you for registering at {{ config('app.name')  }}. Activation is needed to finish off your registration.

Link for activation : {{ url('user/activation', $link)}}