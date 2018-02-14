import { shallow } from '@vue/test-utils'
import Vue from 'vue'
import ExampleComponent from '../components/ExampleComponent.vue'
import CalcComponent from '../components/CalcComponent.vue'

describe('Calc Component', () => {
    it('can add two numbers', () => {
        const vm = new Vue(CalcComponent)
        vm.number1 = 1
        vm.number2 = 5
        expect(vm.result).toEqual(6)
    })
})

describe('Example Component', () => {

    it('increments count when button is clicked', () => {
        const wrapper = shallow(ExampleComponent)
        wrapper.find('button.increment').trigger('click')
        expect(wrapper.find('div').text()).toMatch('1')
    })

    it('decrements count when button is clicked', () => {
        const wrapper = shallow(ExampleComponent)
        wrapper.find('button.increment').trigger('click')
        wrapper.find('button.increment').trigger('click')
        wrapper.find('button.decrement').trigger('click')
        expect(wrapper.find('div').text()).toMatch('1')
    })
})
