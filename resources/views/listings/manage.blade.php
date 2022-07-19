<x-layout>
<div class="bg-gray-50 border border-gray-200 p-10 rounded">
    <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage Gigs
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @foreach ($listings as $item)
    
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="{{route('listing.show', ['listing' => $item->id])}}">
                        {{$item->title}}
                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="{{route('listing.show', ['listing' => $item->id])}} ">
                        {{$item->company}}
                    </a>
                </td>
                
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="{{route('listing.edit', ['listing' => $item->id])}}"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <form method="POST" action="{{route('listing.delete', ['listing' => $item->id])}}">
                        @csrf 
                        @method("DELETE")
                        <button class="text-red-600">
                            <i
                                class="fa-solid fa-trash-can"
                            ></i>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

           
        </tbody>
    </table>
</div>
</x-layout>