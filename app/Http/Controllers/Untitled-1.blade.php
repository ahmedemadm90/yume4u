if (!isset(auth()->user()->role_id)){
{{route('admin.dashboard')}}
}elseif(auth()->user()->role_id == 5){
{{route('user.dashboard')}}
}elseif(auth()->user()->role_id == 4){
{{route('agent.dashboard')}}
}
