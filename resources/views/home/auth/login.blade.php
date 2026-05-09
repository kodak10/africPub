@extends('home.layouts.master')

<style>
    .homepage11-body .header-area.homepage11 .header-elements {
        background: rgb(91 106 241) !important;
    }
    
    .login-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        transition: transform 0.3s ease;
    }
    
    .login-card:hover {
        transform: translateY(-5px);
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
    }
    
    .w-100 {
        width: 100%;
    }
    
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .alert-danger {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        color: #b91c1c;
    }
    
    .checkbox label {
        font-size: 14px;
        color: #6c757d;
        cursor: pointer;
    }
    
    .form-check-input {
        margin-right: 8px;
    }
    
    .login-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #5b6af1, #8b5cf6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .login-icon i {
        font-size: 32px;
        color: #fff;
    }
</style>

@section('content')

<div class="login-section-area sp1 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <!-- Card -->
                <div class="login-card">
                    <div class="login-icon">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <div class="text-center mb-4">
                        <h2 class="text-anime-style-1" style="font-size: 28px;">Connectez-vous</h2>
                        <p class="mt-2" style="color: #6c757d;">Accédez à votre espace personnel et gérez vos campagnes</p>
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-area">
                                    <label class="form-label">
                                        <i class="fa-solid fa-envelope" style="margin-right: 8px; color: var(--primary-color);"></i>
                                        Email *
                                    </label>
                                    <input type="email" name="email" placeholder="exemple@email.com" required value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <div class="input-area">
                                    <label class="form-label">
                                        <i class="fa-solid fa-lock" style="margin-right: 8px; color: var(--primary-color);"></i>
                                        Mot de passe *
                                    </label>
                                    <input type="password" name="password" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" class="form-check-input"> Se souvenir de moi
                                        </label>
                                    </div>
                                    <a href="" style="color: var(--primary-color); font-size: 14px;">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <div class="input-area">
                                    <button type="submit" class="header-btn11 w-100">
                                        Se connecter <span><i class="fa-solid fa-arrow-right"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4 pt-2">
                        <p style="color: #6c757d; margin-bottom: 0;">
                            Pas encore de compte ? 
                            <a href="/#signUp" style="color: var(--primary-color); font-weight: 500;">
                                Inscrivez-vous
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Fin Card -->
            </div>
        </div>
    </div>
</div>

@endsection