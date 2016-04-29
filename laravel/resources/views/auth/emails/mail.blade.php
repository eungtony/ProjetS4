Bonjour,

merci {{ $user->prenom }} de vous être inscrit !

Vous pouvez valider votre compte en vous rendant sur le lien
{{ url('confirm', [$user->id, $token])  }}

Je vous rappelle vos identifiants:
Votre email: {{$user->email}}<br>
Votre: {{$mdp}}

Merci !