<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="favicon.ico" rel="icon" />
    <link rel="stylesheet" href="/css/app.css" />
    <title>Uberflip Technical Challenge</title>
</head>
<body>
    <div class="container mx-auto p-4">
        <div class="flex justify-center items-center">
            <img class="w-16 h-16 mr-4 float-left" src="uberflip.png" alt="Logo" />
            <h1 class="text-2xl font-bold">University Domain List</h1>
        </div>
        <div class="flex flex-col mt-3">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b bg-gray-800">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Name</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">State/Provience</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Country</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Alpha-2-Code</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Domains</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4 text-left">Web Pages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($universities as $university)
                                <tr class="border-b">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $university->name }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $university['state-province'] }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $university->country }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $university->alpha_two_code }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @foreach($university->domains as $domain)
                                        <span>{{ $domain->domain_name }}</span><br />
                                        @endforeach
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @foreach($university->webpages as $url)
                                        <a class="text-blue-700" href="{{ $url->url }}" target="_blank">{{ $url->url }}</a><br />
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $universities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
