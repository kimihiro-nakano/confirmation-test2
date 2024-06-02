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
                <input type="text" class="search-form__item-input" name="content" placeholder="名前やメールアドレスを入力してください" value="{{ old('content') }}">
                <select name="gender" class="search-form__gender-select">
                    <option value="">性別</option>
                    <option value="">全て</option>
                    <option value="">男性</option>
                    <option value="">女性</option>
                    <option value="">その他</option>
                </select>
                <select name="category_id" class="search-form__detail-type-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->content }}</option>
                    @endforeach
                </select>
                <input type="date" name="bday">
            </div>
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>
        </form>
        <form action="" class="reset-form" method="post">
            @csrf
            <div class="reset-form__button">
                <button class="reset-form__button-submit" type="reset">リセット</button>
            </div>
        </form>
    </nav>
    <div class="toolbar">
        <form action="" class="export-csv" method="post">
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
            @foreach ($contacts as $contact)
            <tr class="confirm-table__row">
                <td class="confirm-table__name">{{ $contact->getName() }}</td>
                <td class="confirm-table__gender">{{ $contact->gender_label }}</td>
                <td class="confirm-table__email">{{ $contact->email }}</td>
                <td class="confirm-table__content">{{ $category->content }}</td>
                <td class="confirm-table__detail">
                    <details>
                        <summary>詳細</summary>
                        <div>
                            <p>名前: <span>{{ $contact->getName() }}</span></p>
                            <p>性別: <span>{{ $contact->gender_label }}</span>
                            </p>
                            <p>メール: <span></span>{{ $contact->email }}</p>
                            <p>電話番号: <span>{{ $contact->tell }}</span>
                            </p>
                            <p>住所: <span>{{ $contact->address }}</span></p>
                            <p>建物名: <span>{{ $contact->building}}</span></p>
                            <p>お問い合わせの種類: <span value="{{ $category->id }}">{{ $category->content }}</span></p>
                            <p>お問い合わせ内容: <span>{{ $contact->detail }}</span></p>
                            <form action="/admin" method="post" id="delete-form">
                                @csrf
                                @method('DELETE')
                                <div class="delete-form__button">
                                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                                    <button type="submit">削除</button>
                            </form>
                        </div>
                    </details>
                </td>
            </tr>
            @endforeach
        </table>
    </div>


    @endsection