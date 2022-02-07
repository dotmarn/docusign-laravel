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
            <div class="border border-gray-400 rounded-md shadow-md mx-auto my-auto w-1/2">
                @if ($message = Session::get('success'))
                <div class="bg-green-600 text-white text-center py-2 w-full px-6 mb-4">
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="mb-4 bg-gray-600 text-white py-2 px-6 text-center">
                    <h5 class="">Docusign Demo</h5>
                </div>

                <div class="py-4 px-6">
                    @if ($message = Session::get('success'))
                        @if (!Session::has('payload'))
                        <form action="{{ route('docusign.upload') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-5">
                                <input type="file" name="document" class="border-2 w-full rounded-lg" id="" accept=".pdf" required>
                                @if ($errors->has('document'))
                                    <p class="text-red-600 text-xs">{{ $errors->first('document') }}</p>
                                @endif
                            </div>

                            <div class="mb-5">
                                <label for="">Name:</label>
                                <input type="text" name="signer_name" class="border-2 w-full rounded-lg" id="" required>
                            </div>

                            <div class="mb-5">
                                <label for="">Email:</label>
                                <input type="text" name="signer_email" class="border-2 w-full rounded-lg" id="" required>
                            </div>

                            <div class="mb-5">
                                <label for="">Anchor:</label>
                                <input type="text" name="signature_anchor" class="border-2 w-full rounded-lg" id="" required>
                            </div>

                            <div class="mb-5">
                                <label for="">Position:</label>
                                <select name="position" id="">
                                    <option value="above">Above</option>
                                    <option value="bottom">Bottom</option>
                                    <option value="right">Right</option>
                                    <option value="left">Left</option>
                                </select>
                            </div>

                            <div class="text-center mx-auto">
                                <button type="submit" class="bg-blue-600 text-white rounded-md py-2 px-6">Upload</button>
                            </div>

                        </form>
                        @endif

                        @if (Session::has('payload') && Session::get('docusign_auth_code'))
                        <div class="text-center mx-auto">
                            <a href="{{route('docusign.sign')}}" class="bg-blue-600 text-white rounded-md py-2 px-6">Click to sign document</a>
                        </div>
                        @endif
                    @else
                    <div class="text-center mx-auto">
                        <a href="{{route('connect.docusign')}}" class="bg-blue-600 text-white rounded-md py-2 px-6">Connect Docusign</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
