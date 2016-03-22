<?php

use App\Domaine;
use App\User;
use Illuminate\Support\Facades\Auth;

$domaines = Domaine::with(['cours' => function($query){
        $query->online();
        }])
        ->get();
$prof = User::where('statut_id', 2)->get();

?>

<div class="sidebar flex-item-double wow fadeInLeftBig">
    <h1>Module</h1>
    <ul>
        @foreach($domaines as $d)

            <li>
                <p><a href="{{route('voir.cours.domaine', $d->slug)}}">{{$d->nom}} ({{count($d->cours)}})</a></p>
            </li>

        @endforeach
    </ul>
    <h1>Professeurs</h1>
    <ul>
        @foreach($prof as $p)
            <li><a href="{{route('voir.profil', $p->id)}}">{{$p->nom}} {{$p->prenom}}</a></li>
            @endforeach
    </ul>
    @if(Auth::user() && Auth::user()->statut_id == 2)
    <h1>Administration</h1>
    <ul>
        <li><a href="{{route('admin.dashboard')}}">Gérer mes cours</a></li>
    </ul>
    @endif
    <h1>NewsLetter</h1>
    <input type="text" placeholder="exemple@xyz.fr">
    <button>OK</button>
</div>