<div class="course-badge-labels course--badge-labels collection-dropdown" data-course-id="{{ $course->id }}">
    <div class="generic-action-wrap generic--action-wrap generic--action-wrap-2">
        <div class="dropdown">
            <a class="action-btn bg-white text-gray dropdown-btn" href="#" role="button" id="allCourseMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="la la-ellipsis-v"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right dropdown-menu-wrap" aria-labelledby="allCourseMenuLink" data-course-id="{{ $course->id }}">
                <h6 class="dropdown-header text-black">Collections</h6>
                @foreach (auth()->user()->collections as $collection)
                    <a href="javascript:void(0)" class="dropdown-item collection-link d-flex align-items-center justify-content-between collection-entry-{{$collection->id}}" data-collection-id="{{ $collection->id }}">
                        <span>{{ $collection->name }}</span>
                        @if ($course->collections->contains($collection))
                            <span class="la la-check collection-icon"></span>
                        @else
                            <span class="collection-icon"></span>
                        @endif
                    </a>
                @endforeach

                <div class="section-block my-2"></div>

                <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#createNewCollectionModal{{ $course->id }}">
                    <span>Create New Collection</span> <i class="ml-auto la la-plus"></i>
                </a>
                <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center justify-content-between favorite-btn" data-course-id="{{ $course->id }}">
                    <span class="swapping-btn w-100" data-text-swap="Unfavorite" data-text-original="Favorite">{{ auth()->user()->isFavoritedCourse($course) ? 'Unfavorite' : 'Favorite' }}</span>
                    <i class="ml-auto la la-star"></i>
                </a>

                <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center justify-content-between archive-btn" data-course-id="{{ $course->id }}">
                    <span class="swapping-btn w-100" data-text-swap="Unarchive" data-text-original="Archive">{{ auth()->user()->isArchivedCourse($course) ? 'Unarchive' : 'Archive' }}</span>
                    <i class="la la-archive"></i>
                </a>
            </div>
        </div>
    </div>
</div>