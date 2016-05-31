@foreach ($analyses as $analysis)
    {{ $analysis->title }}

    <?php $workprocesses = $analysis->workprocesses()->get(); ?>

    @foreach ($workprocesses as $workprocess)
        {{ $workprocess->title }}
        <?php $coretask = App\Coretask::find($workprocess->coretask_id) ?>
        {{ $coretask->title }}
    @endforeach
@endforeach