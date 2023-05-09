<input type="file"
    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-slate-900 dark:border-gray-600 dark:placeholder-gray-400"
    name="image" id="file_input">
<p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">png, jpg or gif</p>
<textarea name="description" rows="5" cols="100"
    class="mt-10 w-full border border-gray-200 dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7] rounded-xl
dark:text-white"
    placeholder="{{ __('write a description...') }}"> {{ $post->description ?? '' }} </textarea>
