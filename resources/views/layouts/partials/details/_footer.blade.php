    <p style="text-align: center">
                    <span class="grey-text">
                        <i class="icon history"></i>
                        Last Modification:
                    </span>
        {{ \Carbon\Carbon::parse($location->date_modified)->diffForHumans() }}
    </p>
    <div style="display: flex; justify-content: space-between;">
        <a class="ui black button" href="{{ url()->previous() }}">
            <i class="icon left arrow"></i>
            Back
        </a>

        <div style="display: flex">
            <form id="favorite-form" action="{{ route('location.favorite.store', $location->id) }}" method="POST">
                <button type="submit" id="favorite_button" data-tooltip="{{ $location->isFavoredByUser(auth()->id()) ?
                                "Favored on: " . $location->favoredOn(auth()->id()) : "Add to Favorites?" }}"
                        class="ui {{ $location->isFavoredByUser(auth()->id()) ? "yellow" : "basic" }} icon button" data-inverted="">
                    <i class="icon star"></i>
                </button>
            </form>

            <a class="ui blue button" onclick="$('#share_modal').modal('show');">
                <i class="icon share"></i>
                Share
            </a>
        </div>
    </div>
