package com.example.webapps;

public class Building {

	private String name;
	private int health;
	private int size;
	private String weakness;
	
	public Building (String name, int health, int size, String weakness){
		this.name = name;
		this.health = health;
		this.size = size;
		this.weakness = weakness;
	}

	public String getName() {
		return name;
	}

	public int getHealth() {
		return health;
	}

	public void setHealth(int health) {
		this.health = health;
	}
	
	public boolean isDestroyed(){
		return health <= 0;
	}

	public int getSize() {
		return size;
	}

	public String getWeakness() {
		return weakness;
	}
	
}
