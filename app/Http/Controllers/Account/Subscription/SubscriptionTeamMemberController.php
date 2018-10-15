<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Events\Auth\UserRequestedByTeamOwner;
use App\Http\Requests\Account\SubscriptionTeamMemberStoreRequest;
use App\Http\Requests\Account\SubscriptionTeamUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SubscriptionTeamMemberController extends Controller
{
    public function store(SubscriptionTeamMemberStoreRequest $request) {

        if ($this->teamLimitReached($request)) {
            return back()->with('error', 'You have reached the team limit for your plan.');
        }
        $user = optional(User::where('email', $request->email))->first();
        if ($user) {
            $request->user()->team->users()->syncWithoutDetaching([ $user->id ]);
        } else {
            // Create New User
            $animals = array(
                "Aardvark", "Albatross", "Alligator", "Alpaca", "Ant", "Anteater", "Antelope", "Ape", "Armadillo", "Donkey",
                "Baboon", "Badger", "Barracuda", "Bat", "Bear", "Beaver", "Bee", "Bison", "Boar", "Buffalo", "Butterfly", "Camel",
                "Capybara", "Caribou", "Cassowary", "Cat", "Caterpillar", "Cattle", "Chamois", "Cheetah", "Chicken", "Chimpanzee",
                "Chinchilla", "Chough", "Clam", "Cobra", "Cockroach", "Cod", "Cormorant", "Coyote", "Crab", "Crane", "Crocodile",
                "Crow", "Curlew", "Deer", "Dinosaur", "Dog", "Dogfish", "Dolphin", "Donkey", "Dotterel", "Dove", "Dragonfly", "Duck",
                "Dugong", "Dunlin", "Eagle", "Echidna", "Eel", "Eland", "Elephant", "Elephant-seal", "Elk", "Emu", "Falcon", "Ferret",
                "Finch", "Fish", "Flamingo", "Fly", "Fox", "Frog", "Gaur", "Gazelle", "Gerbil", "Giant-panda", "Giraffe", "Gnat", "Gnu",
                "Goat", "Goose", "Goldfinch", "Goldfish", "Gorilla", "Goshawk", "Grasshopper", "Grouse", "Guanaco", "Guinea-fowl", "Guinea-pig",
                "Gull", "Hamster", "Hare", "Hawk", "Hedgehog", "Heron", "Herring", "Hippopotamus", "Hornet", "Horse", "Human", "Hummingbird", "Hyena",
                "Ibex", "Ibis", "Jackal", "Jaguar", "Jay", "Jellyfish", "Kangaroo", "Kingfisher", "Koala", "Komodo-dragon", "Kookabura", "Kouprey", "Kudu",
                "Lapwing", "Lark", "Lemur", "Leopard", "Lion", "Llama", "Lobster", "Locust", "Loris", "Louse", "Lyrebird", "Magpie", "Mallard", "Manatee",
                "Mandrill", "Mantis", "Marten", "Meerkat", "Mink", "Mole", "Mongoose", "Monkey", "Moose", "Mouse", "Mosquito", "Mule", "Narwhal", "Newt",
                "Nightingale", "Octopus", "Okapi", "Opossum", "Oryx", "Ostrich", "Otter", "Owl", "Ox", "Oyster", "Panther", "Parrot", "Partridge", "Peafowl",
                "Pelican", "Penguin", "Pheasant", "Pig", "Pigeon", "Polar-bear", "Pony", "Porcupine", "Porpoise", "Prairie-dog", "Quail", "Quelea", "Quetzal", "Rabbit", "Raccoon", "Rail", "Ram", "Rat", "Raven", "Red-deer", "Red-panda", "Reindeer", "Rhinoceros", "Rook", "Salamander", "Salmon", "Sand-dollar", "Sandpiper", "Sardine", "Scorpion", "Sea-lion", "Sea-urchin", "Seahorse", "Seal", "Shark", "Sheep", "Shrew", "Skunk", "Snail", "Snake", "Sparrow", "Spider", "Spoonbill", "Squid", "Squirrel", "Starling", "Stingray", "Stinkbug", "Stork", "Swallow", "Swan", "Tapir", "Tarsier", "Termite", "Tiger", "Toad", "Trout", "Turkey", "Turtle", "Vicuña", "Viper", "Vulture", "Wallaby", "Walrus", "Wasp", "Water-buffalo", "Weasel", "Whale", "Wolf", "Wolverine", "Wombat", "Woodcock", "Woodpecker", "Worm", "Wren", "Yak", "Zebra"
            );
            $password = str_random(8);
            $user = User::create([
                'name' => "Anonymous " . $animals[random_int(0, count($animals)-1)],
                'email' => $request->email,
                'password' => Hash::make($password),
                'activated' => false,
            ]);

            event(new UserRequestedByTeamOwner($user, $password));

            $request->user()->team->users()->syncWithoutDetaching([ $user->id ]);
        }
//        $request->user()->team->users()->syncWithoutDetaching([
//
//                User::where('email', $request->email)->first()->id;
//        ]);

        return back()->with('success', 'Team member added.');
    }

    public function destroy(User $user, Request $request) {
        $request->user()->team->users()->detach($user->id);

        return back()->with('success', 'Team member was removed.');
    }

    protected function teamLimitReached($request) {
        return $request->user()->team->users->count() === $request->user()->subscription('main')->quantity;
    }
}
