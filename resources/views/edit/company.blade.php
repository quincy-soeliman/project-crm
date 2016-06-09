<div class="form-group col-xs-12 col-md-12">
    <label for="name">Naam:</label>
    <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Bedrijf" value="{{ $profile->name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="address">Adres:</label>
    <input type="text" class="form-control" autocomplete="off" name="address" placeholder="Adres" value="{{ $profile->address }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="zip_code">Postcode:</label>
    <input type="text" class="form-control" autocomplete="off" name="zip_code" placeholder="Postcode" value="{{ $profile->zip_code }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="iso_number">ISO nummer:</label>
    <input type="text" class="form-control" autocomplete="off" name="iso_number" placeholder="ISO Nummer" value="{{ $profile->iso_number }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="telephone_number">Telefoon nummer:</label>
    <input type="number" class="form-control" autocomplete="off" name="telephone_number" placeholder="Telefoon nummer" value="0{{ $profile->telephone_number }}">
</div>