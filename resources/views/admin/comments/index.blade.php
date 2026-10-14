@extends('admin.layouts.app')

@section('page_title', 'Reader Comments Moderation')

@section('content')

<!-- Header & Filter -->
<div class="p-3 mb-4 rounded bg-white border d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h5 class="fw-bold mb-0 text-dark">Reader Comments Desk</h5>
        <small class="text-muted">Review, approve, or remove user discussion entries</small>
    </div>
    <div class="btn-group btn-group-sm">
        <a href="{{ route('admin.comments.index') }}" class="btn {{ !request()->has('status') ? 'btn-danger' : 'btn-outline-secondary' }}">All</a>
        <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="btn {{ request('status') === 'approved' ? 'btn-danger' : 'btn-outline-secondary' }}">Approved</a>
        <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="btn {{ request('status') === 'pending' ? 'btn-danger' : 'btn-outline-secondary' }}">Pending</a>
    </div>
</div>

<div class="admin-table">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Reader</th>
                    <th>Comment</th>
                    <th>Article</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Moderation</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $cmt)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $cmt->name }}</div>
                            <small class="text-muted">{{ $cmt->email }}</small>
                        </td>
                        <td>
                            <p class="mb-0 small text-secondary" style="max-width: 380px;">{{ $cmt->comment }}</p>
                        </td>
                        <td>
                            @if($cmt->article)
                                <a href="{{ route('article.show', $cmt->article->slug) }}" target="_blank" class="small fw-semibold text-danger d-block text-truncate" style="max-width: 220px;" title="{{ $cmt->article->title }}">
                                    {{ $cmt->article->title }}
                                </a>
                            @else
                                <span class="badge bg-light text-muted">Article Deleted</span>
                            @endif
                        </td>
                        <td>
                            @if($cmt->is_approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td class="small text-muted" style="white-space: nowrap;">
                            {{ $cmt->created_at->format('M j, Y') }}
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <form action="{{ route('admin.comments.toggle', $cmt->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn {{ $cmt->is_approved ? 'btn-outline-warning text-dark' : 'btn-outline-success' }}" title="{{ $cmt->is_approved ? 'Unapprove' : 'Approve' }}">
                                        <i class="fa-solid {{ $cmt->is_approved ? 'fa-eye-slash' : 'fa-check' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.comments.destroy', $cmt->id) }}" method="POST" onsubmit="return confirm('Delete this comment permanently?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete Comment">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fa-regular fa-comments fs-2 d-block mb-2 text-secondary"></i>
                            No comments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($comments->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
    @endif
</div>

@endsection
