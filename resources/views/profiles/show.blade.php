@component('components.app')
    <header class="mb-6 relative">
        <div class="relative">
            <img
                src="/images/default-profile-banner.jpg"
                alt=""
                class="mb-2"
                >

            <img
                src="{{ $user->avatar }}"
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                style="left: 50%"
                width="150"
            >
        </div>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2>{{ $user->name }}</h2>
                <p>Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                <a href="" class="rounded-full border border-grey-300 py-2 px-2 text-black text-xs mr-2">Edit Profile</a>
                @component('components.follow-button', ['user' => $user])
                @endcomponent
            </div>
        </div>

        <p class="text-sm">
            The name’s Bugs. Bugs Bunny. Don’t wear it out. Bugs is an anthropomorphic gray
            and white rabbit or hare who is famous for his flippant, insouciant personality.
            He is also characterized by a Brooklyn accent, his portrayal as a trickster,
            and his catch phrase "Eh...What's up, doc?"
        </p>

    </header>

    @include('_timeline', [
        'tweets' => $user->tweets
    ])
@endcomponent
