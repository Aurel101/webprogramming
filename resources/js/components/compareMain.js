import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class CompareMain extends React.Component{
    constructor(props){
        super(props)
        this.state={
           isLoaded:false,
           error:null,
           result:null
        };

        this.compare_list=[];
        this.compare_list_json=JSON.stringify(this.compare_list);
        this.username = '';
        if (document.getElementById('navbarDropdown')){
            this.username = document.getElementById('navbarDropdown').getAttribute('data-name');
        }
        if (localStorage.getItem(this.username+'compare')){
            this.compare_list_json=localStorage.getItem(this.username+'compare');
            this.compare_list=JSON.parse(this.compare_list_json);
        }

        this.handleClick=this.handleClick.bind(this);
    }
    sendrequest(){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'POST',
            url:'/compare',
            data:'compare='+this.compare_list_json,
        }).done((result)=>{
            this.setState({
                isLoaded:true,
                result:JSON.parse(result)
            });
        });
    }
    componentDidMount(){
        this.sendrequest();
    }
    handleClick(e){
        let id=e.target.value;
        let index = this.compare_list.indexOf(id);
        this.compare_list.splice(index,1);
        this.compare_list_json=JSON.stringify(this.compare_list);
        localStorage.setItem(this.username+'compare',this.compare_list_json);
        this.sendrequest();
    }
    render(){
        if(this.state.isLoaded){
        return(
            <div className='row justify-content-center'>
        {this.state.result.map((post,index) => {return(
            <div className='card col-md-6 col-sm-12 h-100' key={index}>
                <div className='card-header'>
                    <div className='pull-left'>{ post.author} : {post.title}</div>
                    <button className='pull-right' value={post.id} onClick={this.handleClick}>Remove</button>
                </div>
                <div className='card-body row'>
                    <div className='col-12'>
                        <div className='pull-left'><a href={'books/'+post.id}><img className='img-fluid' style={{objectFit : 'cover',width:'300px',height:'300px'}} alt='bookimage' src={'storage/'+post.image}/></a>
                        </div>
                        <div className='pull-right'><div className='d-block'>Author: { post.author}</div>
                            <div className='d-block'>Title: { post.title}</div>
                            <div className='d-block font-weight-bolder' style={{fontSize:'2rem'}}>Price : { post.price}$</div>
                        </div>
                    </div>
                    <div className='col-12'>Publisher : { post.publisher}</div>
                    <div className='col-12'>Publishing date : { new Date(post.publishing_date).toLocaleDateString("en-US")}</div>
                    <div className='col-12'>Condition : { post.condition}</div>
                    <div className='justify-content-center col-12 text-justify'>Description : { post.description}</div>
                </div>
            </div>)
        })}
        <div className='display-1'>{this.state.result.length == 0 ? 'Add posts to compare!':''}</div>
        </div>)
    }
    else{
        return null;
    }
    }
}
if(document.getElementById('compareMain')){
    ReactDOM.render(
        <CompareMain/>,
        document.getElementById('compareMain')
    );
}
