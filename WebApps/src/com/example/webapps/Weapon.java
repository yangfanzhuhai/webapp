package com.example.webapps;

public class Weapon {
	
	private String name;
	private int cost;
	private int power;
	private String strength;
	
	public Weapon(String name, int cost, int power, String strength){
		this.name = name;
		this.cost = cost;
		this.power = power;
		this.strength = strength;
	}

	public String getName() {
		return name;
	}

	public int getCost() {
		return cost;
	}

	public int getPower() {
		return power;
	}

	public String getStrength() {
		return strength;
	}
	
	

}
