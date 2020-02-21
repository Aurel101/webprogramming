import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class CompareButton extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isSubmitting: false,
            isError:false,
            isToggleOn: true,
            isDisabbled:false,
        };
        this.compare_list=[];
        this.id=document.getElementById('compareButton').getAttribute('data-post').toString();
        this.username = '';
        if (document.getElementById('navbarDropdown')) {
            this.username = document.getElementById('navbarDropdown').getAttribute('data-name');
        }
        if (localStorage.getItem(this.username+'compare')){
            this.compare_list=JSON.parse(localStorage.getItem(this.username+'compare'));
        }
        if(this.compare_list.indexOf(this.id)!=-1){
            this.state.isToggleOn=false;
        }
        else if (this.compare_list.length == 2)
        {
            this.state.isDisabbled=true;
        }

        // This binding is necessary to make `this` work in the callback
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        if (localStorage.getItem(this.username+'compare')) {
            this.compare_list = JSON.parse(localStorage.getItem(this.username+'compare'));
        }
        if (this.state.isToggleOn){
            this.compare_list.push(this.id)
        }
        else{
            let index=this.compare_list.indexOf(this.id);
            this.compare_list.splice(index,1);
        }
        this.setState(state => ({
            isToggleOn: !state.isToggleOn
        }));
        console.log(this.compare_list);
        localStorage.setItem(this.username+'compare',JSON.stringify(this.compare_list));

    }

    render() {
        return (
        <div>
            <button disabled={this.state.isDisabbled ? true : false} onClick={this.handleClick}  >
                {this.state.isToggleOn ? ' Add to compare' : 'Remove from compare'}
            </button>
            <sub>
                {this.state.isError ? 'An error occured' : ''}
            </sub>
        </div>
        );
    }
}

export default CompareButton;
if (document.getElementById('compareButton')){
ReactDOM.render(
    <CompareButton />,
    document.getElementById('compareButton')
    );}
