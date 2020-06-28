@extends('layouts.app')

@section('content')
@include('layouts.menubar')
 @foreach($blog as $row)
<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">
                    @if(Session()->get('lang') == 'nepali')
                            {{ $row->post_title_np }}
                            @else
                            {{ $row->post_title_en }}
                            @endif

					 </div>


					<div class="single_post_text">
						<p> @if(Session()->get('lang') == 'nepali')
								{!! $row->details_np !!}
								@else
								{!! $row->details_en !!}
								@endif </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	@endforeach




@endsection