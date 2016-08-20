@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Tags</h3>
		<a href="{{route('admin.tags.create')}}">Create</a>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@forelse($tags as $tag)
				<tr>
					<td>{{$tag->id}}</td>
					<td>{{$tag->name}}</td>
					<td></td>
				@empty
					<td colspan="4"> None tags </td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection