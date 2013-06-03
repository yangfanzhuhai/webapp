package com.example.webapps;
import java.util.List;

public class Level {
	
	private int MAXBUILDINGSIZE = 20;
	
	private List<Building> buildings;
	private List<Weapon> availableWeapons;
	private Weapon currentWeapon;
	private int budget;
	private String name;

	public Level(String name, List<Weapon> availableWeapons, int budget) {
		this.availableWeapons = availableWeapons;
		this.budget = budget;
	}

	public Level(String name, List<Building> buildings, List<Weapon> availableWeapons,
			int budget) {
		this.buildings = buildings;
		this.availableWeapons = availableWeapons;
		this.budget = budget;
	}

	public String getName() {
		return name;
	}

	public int getBudget() {
		return budget;
	}

	private int totalBuildingSize() {
		int size = 0;
		for (Building b : buildings) {
			size += b.getSize();
		}
		return size;
	}

	public boolean addBuilding(Building building) {
		if (totalBuildingSize() + building.getSize() > MAXBUILDINGSIZE) {
			return false;
		} else {
			buildings.add(building);
			return true;
		}
	}

	public boolean attackBuilding(Building building)
			throws BuildingNotFoundException {
		if (!buildings.contains(building)) {
			throw new BuildingNotFoundException();
		} else {
			int currentHealth = building.getHealth();
			int power = currentWeapon.getPower();
			if (building.getWeakness().equals(currentWeapon.getStrength())) {
				power *= 1.5;
			}
			building.setHealth(currentHealth - power);
			if (building.isDestroyed()) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public void chooseWeapon(Weapon weapon) throws WeaponNotFoundException{
		if(!availableWeapons.contains(weapon)){
			throw new WeaponNotFoundException();
		} else {
			currentWeapon = weapon;
			budget -= weapon.getCost();
		}
	}

}
