@extends('layouts.app')
@section('title', 'Dashboard - Comments')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Comments</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Comments</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->
	
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Latest Comments</h4>
				</div>
				<div class="card-body">
					@permission('delete.comments')
					<form action="{{route('comments.bulkDelete')}}" method="POST" id="deleteAll">
						@csrf
						<input type="hidden" name="items" id="bs_items_forbulkDelete">
					</form>
					@endpermission
					<div class="table-responsive">
						<table class="datatable table table-stripped">
							<thead>
								<tr>
									@permission('delete.comments')
									<th>
										<input type="checkbox" id="checkAll"> 
									</th>
									@endpermission
									<th>Count</th>
									<th>User</th>
									<th>Post</th>
									<th>Comment</th>
									<th>Created On</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1 ; ?>
								@foreach($comments as $comment)
								<tr>
									@permission('delete.comments')
									<td style="padding:10px 18px;">
										<input type="checkbox" value="{{$comment->id}}" class="bs_dtrow_checkbox bs_checkItem">
									</td>
									@endpermission
									<td><?=$count++?></td>
									<td>{{ucwords($comment->user->name)}}</td>
									<td> <a href="{{url('/post',$comment->commentable->slug)}}">{{ucwords($comment->commentable->title)}}</a></td>
									<td>{{$comment->body}}</td>
									<td>{{$comment->created_at->format('d:m:Y')}}</td>
									<td>
										@permission('edit.comments')
										<a href="javascript:void(0)" data-route="{{route('comments.edit',$comment->id)}}" class="btn btn-sm bg-success-light mr-2 bs_edit">
											<i class="fe fe-pencil"></i> Edit
										</a>
										@endpermission
										@permission('delete.comments')
										<a href="javascript:void(0)" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('comments.destroy',$comment)}}">
											<i class="fe fe-trash"></i> Delete
										</a>
										@endpermission
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('partials.attr_modal')
@endsection