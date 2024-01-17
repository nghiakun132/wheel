<section class="question">
    <div class="row">
        <div class="col-md-12">
            <div class="logo">
                <img src="{{ asset('image/luckydraw-images-02.png') }}" width="100%" height="100%" />
            </div>

            <div class="group-question">
                <ul class="list-group list-group-numbered">
                    @foreach($questions as $question)
                    <li class="list-group-item">
                        <b>{{$question->question}}</b>
                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                            <li class="list-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer[{{$question->id}}]"
                                        id="answer-{{$answer->id}}" value="{{$answer->id}}">
                                    <label class="form-check-label" for="answer-{{$answer->id}}">
                                        {{$answer->answer}}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>