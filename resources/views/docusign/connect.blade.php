<!DOCTYPE html>
<html lang="en">

<head>
    <title>Docusign Integration Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto">
        <div class="flex flex-col h-screen">
            <div class="border border-gray-400 rounded-md shadow-md text-center mx-auto my-auto w-1/2">
                @if ($message = Session::get('success'))
                <div class="bg-green-600 text-white py-2 w-full px-6 mb-4">
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="mb-4 bg-gray-600 text-white py-2 px-6 text-center">
                    <h5 class="">Docusign Demo</h5>
                </div>

                <div class="py-4 px-6">
                    @if ($message = Session::get('success'))
                        <form action="{{ route('docusign.upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-5">
                                <input type="file" name="document" id="" accept=".pdf">
                                <button type="submit" class="bg-blue-600 text-white rounded-md py-2 px-6">Upload</button>
                            </div>
                        </form>

                        @if (Session::get('file_path') && Session::get('docusign_auth_code'))
                            <a href="{{route('docusign.sign')}}" class="bg-blue-600 text-white rounded-md py-2 px-6">Click to sign document</a>
                        @endif
                    @else
                    <a href="{{route('connect.docusign')}}" class="bg-blue-600 text-white rounded-md py-2 px-6">Connect Docusign</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
