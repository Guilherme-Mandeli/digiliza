<div class="post_navigation d-flex flex-row d-wrap col-12">
    @if( $previousSchedule )
        <a href="{{ route('admin.screens.schedules.show', ['id' => $previousSchedule->id]) }}" class="flex-grow-1 post_navigation_link prev_link">
            <div class="prev_indicator">
                <i class="fas fa-arrow-left"></i>
                <strong>Anterior</strong>
            </div>
            <span class="prev_text"><i class="fas fa-calendar mx-1"></i> {{ $previousSchedule->date }} {{ $previousSchedule->hour }}</span>
        </a>
    @endif

    @if( $nextSchedule )
        <a href="{{ route('admin.screens.schedules.show', ['id' => $nextSchedule->id]) }}" class="flex-grow-1 position-relative end-0 post_navigation_link next_link">
            <div class="next_indicator">
                <i class="fas fa-arrow-right"></i>
                <strong>Próximo</strong>
            </div>
            <span class="next_text"><i class="fas fa-calendar mx-1"></i> {{ $nextSchedule->date }} {{ $nextSchedule->hour }}</span>
        </a>
    @endif
</div>