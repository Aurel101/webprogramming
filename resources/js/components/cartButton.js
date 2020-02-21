import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class CartButton extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isSubmitting: false,
            isError: false,
            isToggleOn: true,
            isDisabbled: false,
        };
        this.cart_button = [];
        this.id = props.id;
        this.username = '';
        if (document.getElementById('navbarDropdown')) {
            this.username = document.getElementById('navbarDropdown').getAttribute('data-name');
        }
        if (localStorage.getItem(this.username+'cart')) {
            this.cart_button = JSON.parse(localStorage.getItem(this.username+'cart'));

        }
        else {
            this.cart_button = [];
        }

        if (this.cart_button.indexOf(this.id) != -1) {
            this.state.isToggleOn = false;
        }

        // This binding is necessary to make `this` work in the callback
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        if (localStorage.getItem(this.username+'cart')) {
            this.cart_button = JSON.parse(localStorage.getItem(this.username+'cart'));

        }
        if (this.state.isToggleOn) {
            this.cart_button.push(this.id)
        }
        else {
            let index = this.cart_button.indexOf(this.id);
            this.cart_button.splice(index, 1);
        }
        this.setState(state => ({
            isToggleOn: !state.isToggleOn
        }));
        globalcart(this.cart_button);
        localStorage.setItem(this.username+'cart', JSON.stringify(this.cart_button));

    }

    render() {
        return (
            <div>
                <button className={this.state.isToggleOn ? 'w-100 btn btn-success btn-block':'w-100 btn btn-danger btn-block'} disabled={this.state.isDisabbled ? true : false} onClick={this.handleClick}  >
                    <i className="fa fa-shopping-cart"></i> {this.state.isToggleOn ? ' Add to cart' : 'Remove from cart'}
                </button>
                <sub>
                    {this.state.isError ? 'An error occured' : ''}
                </sub>
            </div>
        );
    }
}

export default CartButton;
if (document.getElementsByClassName('cartButton').length>0) {
    let elements = document.getElementsByClassName('cartButton');
    let l = elements.length
    for (let i = 0; i < l; i++) {
        let id = elements[i].getAttribute('data-id').toString();
    ReactDOM.render(
        React.createElement(CartButton,{id:id}),
        elements[i]
    );
    }

}
