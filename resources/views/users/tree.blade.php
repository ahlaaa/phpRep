@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            用户树
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <div id="tree"></div>
                   {{--{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}--}}

                        {{--@include('users.fields')--}}

                   {{--{!! Form::close() !!}--}}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
<script>
    var defaultData = [
        {
            text: 'Parent 1',
            href: '#parent1',
            tags: ['4'],
            nodes: [
                {
                    text: 'Child 1',
                    href: '#child1',
                    tags: ['2'],
                    nodes: [
                        {
                            text: 'Grandchild 1',
                            href: '#grandchild1',
                            tags: ['0']
                        },
                        {
                            text: 'Grandchild 2',
                            href: '#grandchild2',
                            tags: ['0']
                        }
                    ]
                },
                {
                    text: 'Child 2',
                    href: '#child2',
                    tags: ['0']
                }
            ]
        },
        {
            text: 'Parent 2',
            href: '#parent2',
            tags: ['0']
        },
        {
            text: 'Parent 3',
            href: '#parent3',
            tags: ['0']
        },
        {
            text: 'Parent 4',
            href: '#parent4',
            tags: ['0']
        },
        {
            text: 'Parent 5',
            href: '#parent5'  ,
            tags: ['0']
        }
    ];
//    $('#tree').treeview({
//        data: tree,
//        levels: 5,
//    });

    $('#tree').treeview({
        color: "#428bca",
        expandIcon: "glyphicon glyphicon-stop",
        collapseIcon: "glyphicon glyphicon-unchecked",
        nodeIcon: "glyphicon glyphicon-user",
        showTags: true,
        data: [$.parseJSON('{!! $user->tree->toJson() !!}')]
    });
</script>
@endsection