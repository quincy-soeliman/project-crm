<div class="form-group col-xs-12 col-md-12">
    <label for="first_name">Voornaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="first_name" placeholder="Voornaam" value="{{ $profile->first_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="last_name">Achternaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="last_name" placeholder="Achternaam" value="{{ $profile->last_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="college_id">School:</label>
    <select autocomplete="off" name="college_id" id="college" placeholder="School"
            class="form-control">
        @foreach ($colleges as $college)
            <option value="{{ $college->id }}">{{ $college->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="reviewers">Beoordelaars:</label>
    <select autocomplete="off" name="reviewers[]" id="reviewer" placeholder="School"
            class="form-control" multiple="multiple" value="">
            @foreach ($profile->reviewers as $student_reviewer) 
                <option selected disabled value="{{ $student_reviewer->id }}">{{ $student_reviewer->first_name }} {{ $student_reviewer->last_name }}</option>
            @endforeach
        @foreach ($reviewers as $reviewer)
            <option value="{{ $reviewer->id }}">{{ $reviewer->first_name }} {{ $reviewer->last_name }}</option>
        @endforeach
    </select>
</div>