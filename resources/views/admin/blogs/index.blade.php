@extends('admin.layouts.app')

@section('content')
    <section id="column-selectors">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Blogs <i class="feather icon-airplay"></i></h4>
                        <button class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><a
                                href="{{ route('admin.blogs.create') }}" class="text-white">Add Blog</a></button>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Featured Image</th>
                                            <th>Description</th>
                                            <th>is Active</th>
                                            <th>Author Name</th>

                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @if (count($data) > 0)
                                            @foreach ($data as $key => $Blog)
                                                <tr>
                                                    <td>{!! \Illuminate\Support\Str::limit($Blog->title, $limit = 20, $end = '...') !!}</td>
                                                    <td>
                                                        @if (!empty($Blog->featured_image))
                                                            <img src="{{ asset('uploads/blogs/' . $Blog->featured_image) }}"
                                                                alt="Blog Image" height="40" width="40"
                                                                class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('/assets/images/placeholder-image.png') }}"
                                                                alt="blog Image" height="40" width="40"
                                                                class="rounded-circle">
                                                        @endif
                                                    </td>

                                                    <td class="description-wrapper"> {!! \Illuminate\Support\Str::limit($Blog->description, $limit = 20, $end = '...') !!}</td>
                                                    {{-- <td style="min-width:7rem !important;">

                                                        @if (!empty($Blog->author_picture))
                                                            <img src="{{ asset('uploads/blogs/' . $Blog->author_picture) }}"
                                                                alt="auhtor_picture Image" height="40" width="40"
                                                                class="rounded-circle">
                                                        @else
                                                            <img src="{{ asset('/assets/images/placeholder-image.png') }}"
                                                                alt="blog Image" height="40" width="40"
                                                                class="rounded-circle">
                                                        @endif

                                                    </td> --}}
                                                    <td style="min-width:7rem !important;">
                                                        <div
                                                            class="custom-control custom-switch custom-switch-success mr-2">
                                                            <input type="checkbox" data-id="{{ $Blog->id }}"
                                                                class="custom-control-input is_active"
                                                                id="customSwitch_{{ $counter }}"
                                                                name="customSwitch_{{ $counter }}" value=""
                                                                {{ $Blog->is_active == 1 ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="customSwitch_{{ $counter }}"></label>
                                                        </div>
                                                    </td>
                                                    <td style="min-width:8rem !important;">
                                                        {{ $Blog->author_name }}</td>
                                                    {{-- <td style="min-width:8rem !important;">
                                                        {{ $Blog->author_description }}</td> --}}
                                                    <td style="min-width:8rem !important;">
                                                        {{ $Blog->category }}</td>
                                                    <td style="min-width:16rem !important;">
                                                        <a href="{!! route('admin.blogs.edit', $Blog->id) !!}"
                                                            class="btn btn-primary btn-sm waves-effect waves-light news-edit-btn"><i
                                                                class="feather icon-edit"></i></a>
                                                        <a href="{!! route('admin.blogs.show', $Blog->id) !!}"
                                                            class="btn btn-info show-btn btn-sm waves-effect waves-light"><i
                                                                class="feather icon-search"></i></a>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm waves-effect waves-light"
                                                            onclick="deleteConfirmation({!! $Blog->id !!})"><i
                                                                class="feather icon-trash"></i></button>
                                                        <form action="{!! URL::route('admin.blogs.destroy', $Blog->id) !!}" method="POST"
                                                            id="deleteForm{!! $Blog->id !!}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php
                                                    $counter++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan=7>
                                                    <p class="text-center my-2">
                                                        No Data to Display
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer-js')
    <script type="text/javascript">
        $(function() {
            $('.is_active').on('change', function() {
                var idHolder = $(this).data('id');
                var isChecked = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.blogs.front') }}',
                    data: {
                        id: idHolder,
                        isChecked: isChecked
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {}
                });
            });
        });
    </script>
@endsection
