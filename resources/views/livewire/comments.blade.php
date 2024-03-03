<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <ul>
            @forelse ($comments as $comment)
                <li>
                    {{ $comment }}
                </li>
            @empty
                <p>No hay comments.</p>
            @endforelse
        </ul>
    </div>
</div>
