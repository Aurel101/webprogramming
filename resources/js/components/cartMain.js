import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class CartMain extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            isLoaded: false,
            error: null,
            result: null
        };

        this.cart_list = [];
        this.cart_list_json = JSON.stringify(this.cart_list);
        this.username = '';
        if (document.getElementById('navbarDropdown')) {
            this.username = document.getElementById('navbarDropdown').getAttribute('data-name');
        }
        if (localStorage.getItem(this.username+'cart')) {
            this.cart_list_json = localStorage.getItem(this.username+'cart');
            this.cart_list = JSON.parse(this.cart_list_json);
        }
        this.handleClick = this.handleClick.bind(this);
        this.proceedtocheckout = this.proceedtocheckout.bind(this)
        this.clearcart=this.clearcart.bind(this);
    }
    sendrequest() {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            url: '/cart',
            data: 'cart=' + this.cart_list_json,
        }).done((result) => {
            this.setState({
                isLoaded: true,
                result: JSON.parse(result)
            });
        });
    }
    proceedtocheckout(){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type:'POST',
            url: '/cart',
            data: 'checkout=' + this.cart_list_json,
        }).done((result)=>{
            this.cart_list=[];
            this.cart_list_json = JSON.stringify([]);
            localStorage.setItem(this.username + 'cart', this.cart_list_json);
            window.location.replace('/checkout');
        });

    }
    clearcart(){
        this.cart_list = []
        this.cart_list_json = JSON.stringify([]);
        localStorage.setItem(this.username + 'cart', JSON.stringify([]));
    }
    componentDidMount() {
        this.sendrequest();
    }
    handleClick(e) {
        let id = e.target.value;
        let index = this.cart_list.indexOf(id);
        this.cart_list.splice(index, 1);
        this.cart_list_json = JSON.stringify(this.cart_list);
        globalcart(this.cart_list);
        localStorage.setItem(this.username+'cart', this.cart_list_json);
        this.sendrequest();
    }
    render() {

        let fullprice=0;
        let button;
        if(this.cart_list.length == 0)
        {
            button = <button className='btn btn-primary' disabled>Your cart is empty!</button>
        }
        else{
            button = <button className='btn btn-primary' onClick={this.proceedtocheckout}>Proceed to checkout</button>;
        }
        if (this.state.isLoaded) {
            return (
                <div className="card col-sm-12 col-md-8 h-100">
                        <div className='card-header'>
                            Your cart!
                        </div>
                        <div className='card-body'>
                    {this.state.result.map((post, index) => {
                        fullprice+=post.price;
                        return (
                            <div className='row col-12 border justify-content-between ' key={index}>
                                <div className="col-sm-12 col-md-8 align-self-center">{post.author} : {post.title}</div>
                                <div className='col-sm-12 col-md-3 align-self-center'>Price : {post.price}$</div>
                                <button className='btn btn-danger col-sm-12 col-md-1' value={post.id} onClick={this.handleClick}> X </button>
                            </div>
                        )
                    })}
                    <div className='display-1'>{this.state.result.length == 0 ? 'Your cart is empty.' : ''}</div>
                </div>
                <div className='card-footer'><div className='pull-left'>Tottal price is : {fullprice}$</div>
                <div className='pull-right'>{button}</div></div>
                </div>)
        }
        else {
            return null;
        }
    }
}
if (document.getElementById('cartMain')) {
    ReactDOM.render(
        <CartMain />,
        document.getElementById('cartMain')
    );
}
