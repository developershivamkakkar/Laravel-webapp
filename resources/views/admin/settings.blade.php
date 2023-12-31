@extends('admin.layouts.app');


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></div>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content  h-100">
        <div class="container-fluid  h-100">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 ">
                    <form action="" method="post" name="settingsForm" id="settingsForm"> <!--form -->
                        <div class="card"> <!-- custom code  --->
                            {{-- <div class="card-header">
                                <a href="{{ route('bloglist') }}" class="btn btn-primary"> Back </a>
                            </div> --}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name"> Website Title </label>
                                    <input type="text" name="website_title" id="website_title" class="form-control"
                                        value="{{ $settings->website_title }}">
                                    <p class="error website_title-error"> </p>
                                </div>

                                <div class="form-group">
                                    <label for="name"> Email </label>
                                    <input type="text" value="{{ $settings->email }}" name="email" id="email"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="name"> Phone </label>
                                    <input type="text" value="{{ $settings->phone }}" name="phone" id="phone"
                                        class="form-control">
                                </div>

                                <div class="mt-4">
                                    <h4> <strong>Social Links</strong> </h4>
                                    <hr>
                                    <div class="form-group">
                                        <label for="name"> Facebook Url </label>
                                        <input type="text" value="{{ $settings->facebook_url }}" name="facebook_url"
                                            id="facebook_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Twitter Url </label>
                                        <input type="text" value="{{ $settings->twitter_url }}" name="twitter_url"
                                            id="twitter_url" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Instagram Url </label>
                                        <input type="text" value="{{ $settings->instagram_url }}" name="instagram_url"
                                            id="instagram_url" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"> Contact Card One </label>
                                            <textarea name="contact_card_one" id="contact_card_one" class="summernote">{!! $settings->contact_card_one !!} </textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"> Contact Card Two </label>
                                            <textarea name="contact_card_two" id="contact_card_two" class="summernote"> {!! $settings->contact_card_two !!}</textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"> Contact Card Three </label>
                                            <textarea name="contact_card_three" id="contact_card_three" class="summernote">{!! $settings->contact_card_three !!} </textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Featured Services</label>
                                        <div class="row">
                                            <div class="col">
                                                <select name="service" id="service" class="form-control">
                                                    @if ($services)
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col">
                                                <button onclick="addService();" class="btn btn-primary">
                                                    Add Service
                                                </button>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" id="services-wrapper">


                                                {{-- <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</div>
                                                <div class="ui-state-default"><span
                                                        class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</div> --}}

                                            </div>
                                        </div>


                                    </div>



                                </div>
                                <button type="submit" name="submit" class="btn btn-primary"> Submit </button>

                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('extraJs')
    <!-- dropzone initalize -->
    <script type="text/javascript">
        $(function() {
            $("#services-wrapper").sortable();
        });

        function addService() {
            var serviceId = $("#service").val()
            var serviceName = $("#service option:selected").text();

            var html =
                `<div class="ui-state-default" data-id='${serviceId}' id=service-${serviceId}><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${serviceName} <button type="button" onclick="deleteService(${serviceId});" class='btn btn-danger btn-sm'>Delete</button></div>`;

            var isFound = false;

            $("#services-wrapper .ui-state-default").each(function() {
                var id = $(this).attr('data-id');
                if (id == serviceId) {
                    isFound = true;
                }
            });

            if (isFound == true) {
                alert("You can not select same service again.");
            } else {
                $("#services-wrapper").append(html);
            }
        }
        //ajax
        $("#settingsForm").submit(function(event) {


            event.preventDefault();
            $("button[type='submit']").prop('disabled', true);



            $.ajax({

                url: '{{ route('settings.save') }}',
                type: 'POST',
                dataType: 'json',
                data: $("#settingsForm").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    if (response.status == 200) {
                        //nooerror
                        window.location.href = '{{ route('settings.index') }}'

                    } else {
                        //Here we will show errors 
                        $('.website_title-error').html(response.errors.website_title);

                    }

                }

            });

        });
    </script>
@endsection
