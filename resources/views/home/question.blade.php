<section class="question">
    <div class="row">
        <div class="col-md-12">
            <div class="logo">
                <img src="{{ asset('image/luckydraw-images-02.png') }}" width="70%" />
            </div>

            <div class="group-question">
                <ul class="list-group list-group-numbered" style="margin-bottom: 40px;">
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
<style>
    #next-btn, #btn-spin {
    border-radius: 38px;
    width: 98%;
    padding: 5px;
    font-size: 35px;
    bottom: 10px;
    position: relative !important;
}
.list-group-numbered>li::before {
    content: counters(section, ".") ". ";
    counter-increment: section;
    font-family: 'SamsungSharpSans-Bold', sans-serif;
}
.list-group-numbered>li>b {
    font-family: 'SamsungSharpSans-Bold', sans-serif;
}
.logo {
    margin-bottom: 15%;
    margin-top: 30px;
}
.list-group-item {
    border: none;
}
</style>