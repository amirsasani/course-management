@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('course.show', $exam) }}" class="btn btn-outline-info mb-4">Back to "{{ $exam->course->title }}"</a>
                <div class="card">
                    <div class="card-header">Update question "{{ strlen($question->title)>50?substr($question->title, 0, 50) . ' ...':$question->title }}"</div>

                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error! </strong>{{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('exam.question.update', ['exam' => $exam, 'question' => $question]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Question title:</label>
                                <input type="text" name="title" class="form-control" id="title"  value="{{ old('title', $question->title) }}">
                            </div>

                            <br><br>

                            <div class="form-group">
                                <label for="choice1">
                                    <input type="radio" name="correct" value="1" {{ (old('correct') == "1" || $choices[0]->correct) ? 'checked' : '' }}> Choice 1:
                                </label>
                                <input type="text" name="choice[]" class="form-control" id="choice1" value="{{ old('choice')[0]?old('choice')[0]:$choices[0]->title }}">
                            </div>

                            <div class="form-group">
                                <label for="choice2">
                                    <input type="radio" name="correct" value="2" {{ (old('correct') == "2" || $choices[1]->correct) ? 'checked' : '' }}> Choice 2:
                                </label>
                                <input type="text" name="choice[]" class="form-control" id="choice2" value="{{ old('choice')[1]?old('choice')[1]:$choices[1]->title }}">
                            </div>

                            <div class="form-group">
                                <label for="choice3">
                                    <input type="radio" name="correct" value="3" {{ (old('correct') == "3" || $choices[2]->correct) ? 'checked' : '' }}> Choice 3:
                                </label>
                                <input type="text" name="choice[]" class="form-control" id="choice3" value="{{ old('choice')[2]?old('choice')[2]:$choices[2]->title }}">
                            </div>

                            <div class="form-group">
                                <label for="choice4">
                                    <input type="radio" name="correct" value="4" {{ (old('correct') == "4" || $choices[3]->correct) ? 'checked' : '' }}> Choice 4:
                                </label>
                                <input type="text" name="choice[]" class="form-control" id="choice4" value="{{ old('choice')[3]?old('choice')[3]:$choices[3]->title }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
