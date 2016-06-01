@foreach ($users as $user)
    @if ($user->active)
        {{ $user->role }}

        <?php
            switch($user->role) {

            }
        ?>

        

    @endif
@endforeach