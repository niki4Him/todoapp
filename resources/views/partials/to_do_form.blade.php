<div class="form-group">
    <label>Title:</label>
    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{old('title', $todo->title)}}">
    @error('title')
        <span class="invalid-feedback d-inline" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button class="btn btn-primary mt-4 btn-block" type="submit">SAVE</button>
</div>
