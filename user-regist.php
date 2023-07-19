<?php
session_start();
// 関数ファイル読み込み
include('function.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ユーザー登録</title>
</head>

<body>

    <section class="">
        <div class=" items-center px-5 py-12 lg:px-20">
            <div class="flex flex-col w-full max-w-md p-10 mx-auto my-6 transition duration-500 ease-in-out transform bg-white rounded-lg md:mt-0">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">新規ユーザー登録</h2>
                <p class="mx-auto max-w-screen-md text-center text-gray-500 md:text-lg">ユーザー登録しないと使えないよ</p>
                <div class="mt-8">
                    <div class="mt-6">
                        <form action="user_create.php" method="POST" class="space-y-6" data-bitwarden-watching="1">
                            <div>
                                <label for="" class="block text-sm font-medium text-neutral-600"> ユーザーコード
                                </label>
                                <div class="mt-1">
                                    <input id="" name="user_code" type="text" autocomplete="" required="" placeholder="ユーザーコード" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                </div>
                            </div>
                            <div>
                                <label for="" class="block text-sm font-medium text-neutral-600"> ユーザー名</label>
                                <div class="mt-1">
                                    <input id="" name="user_name" type="text" autocomplete="" required="" placeholder="ユーザー名" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                </div>
                            </div>
                            <label for="" class="block text-sm font-medium text-neutral-600"> 権限</label>
                            <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                                <div class="flex items-center">
                                    <input id="kanrisya" name="user_flg" type="radio" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" value="0">
                                    <label for="kanrisya" class="ml-3 block text-sm font-medium leading-6 text-gray-900">編集者</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="eturansya" name="user_flg" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" value="1">
                                    <label for="eturansya" class="ml-3 block text-sm font-medium leading-6 text-gray-900">閲覧者</label>
                                </div>
                            </div>



                            <div>
                                <label for="" class="block text-sm font-medium text-neutral-600"> メールアドレス
                                </label>
                                <div class="mt-1">
                                    <input id="" name="user_mail" type="email" autocomplete="" required="" placeholder="メールアドレス" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                </div>
                            </div>
                            <div>
                                <label for="" class="block text-sm font-medium text-neutral-600"> パスワード
                                </label>
                                <div class="mt-1">
                                    <input id="" name="user_pass" type="password" autocomplete="" required="" placeholder="パスワード" class="block w-full px-5 py-3 text-base text-neutral-600 placeholder-gray-300 transition duration-500 ease-in-out transform border border-transparent rounded-lg bg-gray-50 focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="flex items-center justify-center w-full px-10 py-4 text-base font-medium text-center text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">新規ユーザー登録</button>
                            </div>
                        </form>
                        <div class="relative my-4">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


</body>


</html>