@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Testimonial <i class="feather icon-message-circle"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" id="testimonialUpdateForm" action="{{ route('admin.testimonials.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-0 d-flex flex-column-reverse align-items-start justify-content-center">
                                            <input type="hidden" name="image_input" id="image_input" value="{{$data->image}}">
                                            <input type="file" name="image" id="file"  class="d-none" accept="image/*">
                                            <button type="button" onclick="document.getElementById('file').click()" class="btn btn-primary my-1" id="uploadButton">Change Profile Photo</button>
                                            <div class="cross-container d-flex">
                                                @if(isset($data->image)  && $data->image !== '' )
                                                    <img id="preview" src="{{ asset(uploadsDir('testimonials') . $data->image) }}" required alt="Background Picture Preview" class="d-inline-flex rounded-lg" height="80" width="80">
                                                @else
                                                    <img id="preview" src="{{ asset('assets/images/placeholder-image.png') }}" alt="Background Picture Preview" class="d-inline-flex rounded-lg" height="80" width="80">
                                                @endif
                                                <button type="button" id="clearImageButton" class="d-flex align-items-start p-0 border-0 bg-transparent">
                                                    <img class="rounded-sm" src="{{ asset('assets/admin/images/cross-arrow-blue.svg') }}" width="13" height="13">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 pl-0">
                                    <div class="form-group mb-1">
                                        <label for="is_active">Is Active</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="page_title">Name</label>
                                            <input required type="text" name="name" value="{{$data->name}}" placeholder="Add Name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="page_title">Designation</label>
                                            <input required type="text" name="designation" value="{{$data->designation}}" placeholder="Add Designation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-2">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" required name="description" placeholder="Add Description" rows="4">{{$data->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-md-12 pl-0">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer-js')
    <script type="text/javascript">
    $(document).ready(function() {
        $("#clearImageButton").click(function() {
            $("#file").val("");
            $("#preview").attr("src", "");
            $('.cross-container').hide();
            $('.cross-container').removeClass('d-flex');
            $('#image_input').val('');
        });
        $('#file').on('change', function(e){
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('.cross-container').show();
                $('.cross-container').addClass('d-flex');
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $.validator.addMethod("imageFileType", function(value, element) {
            // Get the file extension
            var extension = value.split('.').pop().toLowerCase();
            // Check if the extension is one of the allowed image types
            return ['jpg', 'jpeg', 'png', 'gif'].indexOf(extension) !== -1;
        }, "Please select a valid image file (jpg, jpeg, png, gif)");

        $('#testimonialUpdateForm').validate({
            rules: {
                name: {
                    required: true,
                },
                designation: {
                    required: true,
                },
                description: {
                    required: true,
                },
                image: {
                    required: true,
                    imageFileType: true
                },
            },
            messages: {
                name: {
                    required: "Please enter your name",
                },
                designation: {
                    required: "Please enter your designation",
                },
                description: {
                    required: "Please enter your description",
                },
                image: {
                    required: "Please select profile image",

                },
            },
        });
    });
    </script>
@endsection
