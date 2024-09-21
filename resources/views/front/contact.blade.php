@extends('front.layouts.master')
@section('title', 'İletişim')
@section('content')
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Bizimle İletişime geçin!</p>
                    <div class="my-5">
                        <form method="POST" action="{{ route('contact.post') }}">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control" id="name" type="text" name="name"
                                    placeholder="Lütfen adınızı ve soyadınızı girin." data-sb-validations="required"
                                    value="{{ old('name') }}" />
                                <label for="name">Ad Soyad</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" type="email" name="email"
                                    placeholder="Email adresinizi girin." data-sb-validations="required,email"
                                    value="{{ old('email') }}" />
                                <label for="email">Email adresi</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.
                                </div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="mt-4">
                                <label for="phone">Konu</label>
                                <select name='topic' class="form-select">
                                    <option @if (old('topic') == 'bilgi') selected @endif value="bilgi">Bilgi</option>
                                    <option @if (old('topic') == 'destek') selected @endif value="destek">Destek</option>
                                    <option @if (old('topic') == 'genel') selected @endif value="genel">Genel</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" id="message" name="message" placeholder="Lütfen mesajınızı girin."
                                    style="height: 12rem" data-sb-validations="required">{{ old('message') }}</textarea>
                                <label for="message">Mesaj</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.
                                </div>
                            </div>
                            <br />
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a
                                        href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
