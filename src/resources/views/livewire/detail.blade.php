<div>
    <button wire:click="openDetail()" type="button">
        詳細
    </button>

    @if($showDetail)
        <div class="detail">
            <button class="close-button" wire:click="closeDetail" type="button">×</button>
        <div class="detail-content">
            <p>名前: <span>{{ $contact->getName() }}</span></p>
            <p>性別: <span>{{ $contact->gender_label }}</span></p>
            <p>メール: <span>{{ $contact->email }}</span></p>
            <p>電話番号: <span>{{ $contact->tell }}</span> </p>
            <p>住所: <span>{{ $contact->address }}</span></p>
            <p>建物名: <span>{{ $contact->building }}</span></p>
            <p>お問い合わせの種類: <span value="{{ $category->id }}">{{ $category->content }}</span></p>
            <p>お問い合わせ内容: <span>{{ $contact->detail }}</span></p>
            <form action="/admin/delete?id={{ $category->id }}" method="post" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{ $contact->id }}">
                    <button type="submit">削除</button>
                </div>
            </form>
        </div>
        </div>
    @endif
</div>

<style>
    .detail {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    .detail-content {
        margin-top: 1rem;
    }

    .close-button {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
    }
</style>
