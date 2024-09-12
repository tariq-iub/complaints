@extends('layouts.powereye')

@section('content')
<div class="mb-9">
    <!-- Hero Section -->
    <div class="mx-n4 mx-lg-n6 mt-n5 position-relative mb-md-9" style="height:208px">
        <div class="bg-holder bg-card d-dark-none" style="background-image:url(../../assets/img/bg/bg-40.png);background-size:cover;"></div>
        <div class="bg-holder bg-card d-light-none" style="background-image:url(../../assets/img/bg/bg-dark-40.png);background-size:cover;"></div>
        <div class="faq-title-box position-relative bg-body-emphasis border border-translucent p-6 rounded-3 text-center mx-auto">
            <h1>How can we help?</h1>
            <p class="my-3">Search for the topic you need help with or <a href="#!">contact our support</a></p>
            <div class="search-box w-100">
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                    <input class="form-control search-input search" type="search" aria-label="Search">
                    <svg class="svg-inline--fa fa-magnifying-glass search-box-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path>
                    </svg>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row gx-xl-8 gx-xxl-11 gy-6 faq">
        <!-- Sidebar Column -->
        <div class="col-md-6 col-xl-5 col-xxl-4">
            <div class="faq-sidebar bg-body z-5 w-100" id="faq-offcanvas">
                <ul class="faq-category-tab nav nav-tabs mb-10 mb-md-5 pb-3 pt-2 w-100 mx-auto" role="tablist">
                    <!-- Popular Categories Button -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold me-3 fs-8" id="popular-tab" type="button" data-bs-toggle="tab" data-bs-target="#popular-content" aria-selected="false" role="tab">
                            Popular Categories
                        </button>
                    </li>
                    <!-- All Categories Button -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold fs-8 active" id="all-tab" type="button" data-bs-toggle="tab" data-bs-target="#all-content" aria-selected="true" role="tab">
                            All Categories
                        </button>
                    </li>
                </ul>
                <!-- Popular Categories Content -->
                <div class="tab-content">
                    <div class="tab-pane fade" id="popular-content" role="tabpanel" aria-labelledby="popular-tab">
                        <div class="faq-subcategory-tab nav nav-tabs w-md-100 mx-auto mb-4" id="faq-subcategory-tab" role="tablist">
                            @foreach ($popfaqCategories as $category)
                                <div class="nav-item w-100 mb-3" role="presentation">
                                    <button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8"
                                        id="tab-{{ $category->id }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#faq-{{ $category->id }}"
                                        type="button"
                                        role="tab"
                                        aria-selected="true">
                                        
                                        <!-- Category Icon -->
                                        <td class="align-middle icon">
                                            @if($category->contents && $category->contents->icons)
                                                <span data-feather="{{ $category->icon }}"></span>
                                                <span class="ms-2">
                                                  {{ $category->icon }}
                                                </span>
                                            @else
                                             @endif
                                        </td>
                                        <!-- Category Title -->
                                        <span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">{{ $category->name }}</span>
                                        
                                        <!-- Category Description -->
                                        @if ($category->contents && $category->contents->description)
                                            <span class="d-block text-body fw-normal mb-0 fs-9">{{ $category->contents->description }}</span>
                                        @endif
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- All Categories Content -->
                    <div class="tab-pane fade show active" id="all-content" role="tabpanel" aria-labelledby="all-tab">
                        <div class="faq-subcategory-tab nav nav-tabs w-md-100 mx-auto mb-4" id="faq-subcategory-tab" role="tablist">
                            @foreach ($faqCategories as $category)
                                <div class="nav-item w-100 mb-3" role="presentation">
                                    <button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8"
                                        id="tab-{{ $category->id }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#faq-{{ $category->id }}"
                                        type="button"
                                        role="tab"
                                        aria-selected="true">
                                        
                                        <!-- Category Icon -->
                                        @if ($category->contents && $category->contents->icons)
                                            <img src="{{ $category->contents->icons }}" alt="Category Icon" class="category-icon">
                                        @else
                                        @endif
                                        
                                        <!-- Category Title -->
                                        <span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">{{ $category->name }}</span>
                                        
                                        <!-- Category Description -->
                                        @if ($category->contents && $category->contents->description)
                                            <span class="d-block text-body fw-normal mb-0 fs-9">{{ $category->contents->description }}</span>
                                        @endif
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col-md-6 col-xl-7 col-xxl-8 mt-md-12">
            <div class="faq-subcategory-content">
                <div class="tab-content">
                    @foreach ($faqCategories as $category)
                        <div class="tab-pane fade" id="faq-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                            <ul class="list-inline mb-0">
                                @foreach ($category->statements as $index => $statement)
                                    <li class="d-flex mt-6 align-items-start">
                                        @if ($statement->rank <= 3)
                                            <!-- Star Icon for top 3 statements -->
                                            <svg class="svg-inline--fa fa-star fs-8 text-primary me-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path>
                                            </svg>
                                        @else
                                            <!-- Divider Line after the third statement -->
                                            @if ($index == 2)
                                                <hr class="my-4 border-top border-primary">
                                            @endif
                                            <!-- Circle Icon for remaining statements -->
                                            <svg class="svg-inline--fa fa-circle fs-10 text-body-secondary me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path>
                                            </svg>
                                        @endif
                                        <div class="ms-3">
                                            <!-- <hr class="my-4 border-top border-primary"> -->
                                            <h4 class="mb-3 text-body-highlight">{{ $statement->statement }}</h4>
                                            <p class="mb-0 text-body-tertiary">{{ $statement->answer }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .border-top {
    border-top-width: 100px; /* Adjust the width as needed */
}

</style>
@endsection
