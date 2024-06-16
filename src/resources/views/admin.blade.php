@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
<div class="header-logout__button">
    @if (Auth::check())
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="header-logout__button-submit" type="submit">logout</button>
    </form>
    @endif
</div>
@endsection

@section('content')
<div class="admin__content">
    <div class="content__title">
        <h2>Admin</h2>
    </div>
    <nav class="content__navbar">
        <form action="{{ route('admin.search') }}" class="search-form" method="get">
            @csrf
            <div class="search-form__item">
                <label for="exact_match"></label>
                <input type="text" class="search-form__item-input" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword', $keyword ?? '') }}">
                <select name="gender" class="search-form__gender-select">
                    <option value="">性別</option>
                    <option value="all" {{ old('gender', $gender ?? '') == 'all' ? 'selected' : '' }}>全て</option>
                    <option value="male" {{ old('gender', $gender ?? '') == 'male' ? 'selected' : '' }}>男性</option>
                    <option value="female" {{ old('gender', $gender ?? '') == 'female' ? 'selected' : '' }}>女性</option>
                    <option value="other" {{ old('gender', $gender ?? '') == 'other' ? 'selected' : '' }}>その他</option>
                </select>
                <select name="category_id" class="search-form__detail-type-select">
                    <option value="" selected>お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
                <input type="date" name="date" value="{{ old('date', $date ?? '') }}">
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>
        </form>
        <form action="{{ route('admin.reset') }}" class="reset-form" method="get">
            <div class="reset-form__button">
                <button class="reset-form__button-submit" class="reset">リセット</button>
            </div>
        </form>
    </nav>
    <div class="toolbar">
        <form action="{{ route('admin.export') }}" class="export-csv" method="post">
            @csrf
            <div class="export-csv__button">
                <button class="export-csv__button-submit" type="submit">エクスポート</button>
            </div>
        </form>
    </div>
    <div class="categories-paginate">
        {{ $contacts->links() }}
    </div>
    <div class="confirm-table">
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header-span">お名前</th>
                <th class="confirm-table__header-span">性別</th>
                <th class="confirm-table__header-span">メールアドレス</th>
                <th class="confirm-table__header-span">お問い合わせの種類</th>
            </tr>
            @if($contacts->isNotEmpty())
                @foreach ($contacts as $contact)
                    <tr class="confirm-table__row">
                        <td class="confirm-table__name">{{ $contact->getName() }}</td>
                        <td class="confirm-table__gender">{{ $contact->gender_label }}</td>
                        <td class="confirm-table__email">{{ $contact->email }}</td>
                        <td class="confirm-table__content">{{ $contact->category->content }}</td>
                        <td class="confirm-table__detail">
                        @livewire('detail', compact('contact', 'category'))
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endsection
